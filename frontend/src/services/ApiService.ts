import axios, { type AxiosResponse } from 'axios';

const baseUrl: string = window.location.origin;
const backUrl: string = import.meta.env.VITE_BACKEND_URL;
const googleApiKey: string = import.meta.env.VITE_GOOGLE_API_KEY;

interface ShortenUrlResponse {
  hash: string;
  folder: string;
}

interface FecthOriginalUrlResponse {
  originalUrl: string;
}

const apiService = {
  async shortenUrl(url: string, folder: string): Promise<string> {
    try {
      const response: AxiosResponse<ShortenUrlResponse> = await axios.post(
        `${backUrl}api/shorten-url`,
        {
          originalUrl: url,
          folder: folder
        }
      );
      
      if (response.data) {
        const shortenUrl = `${baseUrl}/${response.data.folder}/${response.data.hash}`;
        return shortenUrl;
      } else {
        throw new Error('Invalid response from the server');
      }
    } catch (error) {
      throw new Error('Failed to shorten URL. Please try again.');
    }
  },
  async fetchOriginalUrl(hash: string, folder: string): Promise<string> {
    try {
      const response: AxiosResponse<FecthOriginalUrlResponse> = await axios.post(
        `${backUrl}api/fetch-original`,
        {
          hash: hash,
          folder: folder
        }
      );

      if (response.data.originalUrl) {
        return response.data.originalUrl;
      } else {
        throw new Error('Invalid response from the server');
      }
    } catch (error) {
      throw new Error('Failed to fetch the original URL');
    }
  }
};

export default apiService;
