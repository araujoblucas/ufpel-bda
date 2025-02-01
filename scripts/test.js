import http from 'k6/http';
import { check, sleep } from 'k6';

export const options = {
    vus: 100,
    duration: '30s',
};

export default function () {
    let res = http.get('http://nginx/test');

    console.log(`Response: ${JSON.stringify(res)}`);

    if (!res) {
        console.error("Erro: resposta nula ou indefinida");
        return;
    }

    check(res, {
        'status é 200': (r) => r.status === 200,
        'responde rápido': (r) => r.timings.duration < 500,
    });

    sleep(1);
}
