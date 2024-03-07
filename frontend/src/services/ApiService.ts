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

      console.log(response.data);

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
  async checkSecurity(url: string): Promise<boolean> {
    try {
      const response = await axios.post(
        `https://safebrowsing.googleapis.com/v4/threatMatches:find?key=${googleApiKey}`,
        {
          client: {
            clientId: 'urlshortener',
            clientVersion: '1.5.2'
          },
          threatInfo: {
            threatTypes: ['MALWARE', 'SOCIAL_ENGINEERING'],
            platformTypes: ['WINDOWS'],
            threatEntryTypes: ['URL'],
            threatEntries: [{ url: url }]
          }
        }
      );

      // Check if the body is empty => url is secure
      return Object.keys(response.data).length === 0;
    } catch (error) {
      throw new Error('Failed to validate URL security.');
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
