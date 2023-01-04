import _ from "lodash";
import axios$1 from "axios";
window._ = _;
window.axios = axios$1;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
const getTodos = async () => {
  return axios.get("https://jsonplaceholder.typicode.com/todos/1").then((r) => console.log(r.data));
};
getTodos();
