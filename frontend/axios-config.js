import axios from 'axios';

// Create an instance of axios with default configuration
const instance = axios.create({
  baseURL: 'http://localhost:8000/api', // Set your base URL here
  timeout: 5000, 
  headers: {
    'Content-Type': 'multipart/form-data', 
    'Accept': 'application/json'
  }
});

export default instance;