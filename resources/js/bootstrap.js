import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Add CSRF token to requests
const token = document.querySelector('meta[name="csrf-token"]')?.content;
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
}
