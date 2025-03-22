import http from 'k6/http';
import { check } from 'k6';
export let options = {
    vus: 15,
    duration: '30s',
};
export default function () {
    let route = 'http://nginx/product/create'
    let res = http.get(route);
    // Basic checks on the HTTP response
    check(res, {
        'status is 200': (r) => r.status === 200,
        'response time < 500ms': (r) => r.timings.duration < 500,
    });

    console.log(route)
}