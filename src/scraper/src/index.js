import { scrapeNews } from './scraper/scraper.js';
import { logger } from './logger/winston.js';
import { sendToBackend } from './api/apiClient.js';


async function runScraper() {
  try {
    logger.info("Scraper is running.");

    const newsData = await scrapeNews();
    logger.info("Scraping completed.");

    await sendToBackend(newsData);
    logger.info("Process completed.");
  } catch (error) {
    logger.error('Authentication error:', error.response ? error.response.data : error.message);
  }
}

const FIVE_MINUTES = 5 * 60 * 1000;
setInterval(runScraper, FIVE_MINUTES);

runScraper();
