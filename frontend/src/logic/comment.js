import axios from "axios";
import store from "@/store/index";

const commentAPI = "http://localhost:8000/api/comments";

export default {
  get: (blog_id) =>
    axios({
      method: "GET",
      url: commentAPI + `/${blog_id}`,
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Content-type": "application/json",
      },
    })
      .then((res) => {
        return res.data;
      })
      .catch((error) => {
        console.log(error.response.status);
        console.log(error.response.data);
      }),
  create: (data, token) =>
    axios({
      method: "POST",
      url: commentAPI + "/store",
      data: data,
      headers: {
        "Access-Control-Allow-Origin": "*",
        Authorization: token,
        "Content-type": "application/json",
      },
    })
      .then((res) => {
        return res.data;
      })
      .catch((error) => {
        console.log(error.response.status);
        console.log(error.response.data);
        store.dispatch("setErrorMessage", error.response.data["error"]);
      }),
};
