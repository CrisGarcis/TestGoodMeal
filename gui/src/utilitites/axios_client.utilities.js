import axios from "axios";

export let createClient = () => {

  return axios.create({
    baseURL: process.env.VUE_APP_API_HOST,
    headers: {
      
    }
  });
};

export default createClient;
