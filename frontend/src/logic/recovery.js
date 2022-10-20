import axios from "axios";
import store from "@/store/index";

const forgotAPI = "http://localhost:8000/api/forgot";
const resetAPI = "http://localhost:8000/api/reset";

export default {
  forgotPasswordRequest: (email) =>
    axios({
      method: "POST",
      url: forgotAPI,
      data: email,
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
        store.dispatch("setErrorMessage", error.response.data["error"]);
      }),
  changePasswordRequest: (data) =>
    axios({
      method: "PATCH",
      url: resetAPI,
      data: data,
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
        store.dispatch("setErrorMessage", error.response.data["error"]);
      }),
};
