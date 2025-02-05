import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

//window.axios.defaults.headers.common['X-XSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;

// Set CSRF Token for Axios requests
const csrfToken = document.head.querySelector('meta[name="csrf-token"]')?.content;
if (csrfToken) {
  window.axios.defaults.headers.common['X-XSRF-TOKEN'] = csrfToken;
} else {
  console.error("CSRF token is missing in the meta tag");
}
