import axios, { type AxiosResponse } from 'axios';

const baseURL: string = import.meta.env.VITE_BASE_URL;
const backUrl: string = import.meta.env.VITE_BACKEND_URL;

interface ShortenUrlResponse {
  hash: string;
}

const apiService = {
  async shortenUrl(url: string): Promise<string> {
    try {
      const response: AxiosResponse<ShortenUrlResponse> = await axios.post(
        `${backUrl}api/shorten-url`,
        {
          originalUrl: url
        }
      );

      if (response.data.hash) {
        const shortenUrl = `${baseURL}${response.data.hash}`;
        return shortenUrl;
      } else {
        throw new Error('Invalid response from the server');
      }
    } catch (error) {
      throw new Error('Failed to shorten URL. Please try again.');
    }
  }
};

export default apiService;
