var axios = require('axios');

var axiosInstance = axios.create({
  baseURL: 'http://localhost:4000/api',
  responseType: 'json',
  responseEncoding: 'utf8',
  headers: {
    "Content-Type": "application/json;charset=UTF-8",
    "Access-Control-Allow-Origin": "*"
  }
});

module.exports = axiosInstance;