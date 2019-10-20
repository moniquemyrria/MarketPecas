var axios = require('axios')

var axiosInstance = axios.create({
  baseURL: 'http://localhost/MarketPecas/Back-end/public',
  responseType: 'json',
  responseEncoding: 'utf8',
  headers: {
    'Content-Type': 'application/json;charset=UTF-8',
    'Access-Control-Allow-Origin': '*',
  },
})

module.exports = axiosInstance