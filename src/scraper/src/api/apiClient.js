import axios from "axios";
import dotenv from 'dotenv';
import { logger } from "../logger/winston.js";

dotenv.config();

const {
    API_BASE_URL,
    CALLBACK_ENDPOINT,
    CSRF_ENDPOINT,
    AUTHENTICATE_ENDPOINT,
    USER_EMAIL,
    USER_PASSWORD
} = process.env;

const apiClient = axios.create({
    baseURL: API_BASE_URL,
    withCredentials: true,
    withXSRFToken: true,
    headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' }
});

async function authenticate() {
    try {
        const response = await apiClient.post(AUTHENTICATE_ENDPOINT, {
            email: USER_EMAIL,
            password: USER_PASSWORD
        });

        apiClient.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;
        logger.info('Authentication successful');
        return true;
    } catch (error) {
        logger.error('Invalid credentials');
        return false;
    }
}

export const sendToBackend = async (data, retryCount = 0) => {
    const MAX_RETRIES = 1;

    try {
        await apiClient.get(CSRF_ENDPOINT);

        const response = await apiClient.post(CALLBACK_ENDPOINT, data);
        logger.info(`Data successfully sent to backend: ${response.status}`);
        return response.data;

    } catch (error) {
        if ((error.response?.status === 401) && retryCount < MAX_RETRIES) {
            logger.info('Unauthorized, attempting to authenticate...');

            const authSuccess = await authenticate();

            if (authSuccess) {
                logger.info('Retrying request after successful authentication');
                return sendToBackend(data, retryCount + 1);
            }
        }

        logger.error('Failed to send data.');
        throw error;
    }
};
