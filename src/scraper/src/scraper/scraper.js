import puppeteer from 'puppeteer-core';
import dotenv from 'dotenv';
import { logger } from '../logger/winston.js';

dotenv.config();

const { NEWS_SITE_URL, CHROMIUM_EXECUTABLE_PATH } = process.env;

export const scrapeNews = async () => {
    const browser = await puppeteer.launch({ headless: true, executablePath: CHROMIUM_EXECUTABLE_PATH });
    const page = await browser.newPage();

    logger.info('New browser page opened.');

    try {
        await page.goto(NEWS_SITE_URL, { waitUntil: "domcontentloaded", timeout: 0 });

        const newsItems = await page.evaluate(() => {

            const mansetSlider = document.getElementById('manset-slider');

            const slides = mansetSlider.querySelectorAll('.swiper-slide[data-swiper-slide-index]');
            const headlines = [];

            slides.forEach(slide => {
                const titleElement = slide.querySelector('h3.baslik');
                const linkElement = slide.querySelector('a');

                if (titleElement && linkElement) {
                    const title = titleElement.textContent?.trim() || '';
                    const href = linkElement.getAttribute('href') || '';

                    headlines.push({
                        title,
                        href
                    });
                }
            });

            return headlines;
        });

        const newsData = [];

        for (const item of newsItems) {
            await page.goto(item.href, { waitUntil: "domcontentloaded" });

            const wordCount = await page.evaluate(() => {
                const contentElement = document.querySelector('.news-detail [property="articleBody"]');
                const paragraphs = contentElement?.querySelectorAll('p');

                const text = Array.from(paragraphs || [])
                    .map(p => p.textContent?.trim() || '')
                    .join(' ');

                return text.split(/\s+/).length;
            });

            newsData.push({
                title: item.title,
                word_count: wordCount
            });
        }

        logger.info('News data was collected and exported.');

        await browser.close();

        return newsData;

    } catch (error) {
        logger.error('Scraping error', error);
    }
};
