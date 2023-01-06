import axios from "axios";
export let client = () => {
let {VITE_API_HOST}=import.meta.env;
console.log("process.env");

  return axios.create({
    baseURL: VITE_API_HOST
  });
};

export default client;
