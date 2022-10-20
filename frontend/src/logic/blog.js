import axios from "axios";
import store from "@/store/index";

const blogAPI = "http://localhost:8000/api/blog";
const blogsAPI = "http://localhost:8000/api/blogs";

export default {
  get: () =>
    axios({
      method: "GET",
      url: blogsAPI,
      headers: {
        "Access-Control-Allow-Origin": "*",
        "Content-type": "application/json",
      },
    })
      .then((res) => {
        return res;
      })
      .catch((error) => {
        console.log(error.response.status);
        console.log(error.response.data);
      }),
  create: (data, token) =>
    axios({
      method: "POST",
      url: blogsAPI,
      data: data,
      headers: {
        "Access-Control-Allow-Origin": "*",
        Authorization: token,
        "Content-type": "application/json",
      },
    })
      .then((res) => {
        return res;
      })
      .catch((error) => {
        console.log(error.response.status);
        console.log(error.response.data);
        store.dispatch("setErrorMessage", error.response.data["error"]);
      }),
  update: (id, data, token) =>
    axios({
      method: "PATCH",
      url: blogAPI + `/${id}`,
      data: data,
      headers: {
        "Access-Control-Allow-Origin": "*",
        Authorization: token,
        "Content-type": "application/json",
      },
    })
      .then((res) => {
        return res;
      })
      .catch((error) => {
        console.log(error.response.status);
        console.log(error.response.data);
        store.dispatch("setErrorMessage", error.response.data["error"]);
      }),
  delete: (id, token) =>
    axios({
      method: "DELETE",
      url: blogAPI + `/${id}`,
      headers: {
        "Access-Control-Allow-Origin": "*",
        Authorization: token,
        "Content-type": "application/json",
      },
    })
      .then((res) => {
        return res;
      })
      .catch((error) => {
        console.log(error.response.status);
        console.log(error.response.data);
        store.dispatch("setErrorMessage", error.response.data["error"]);
      }),
};
