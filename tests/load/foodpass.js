import http from 'k6/http';
import { check, sleep } from 'k6';

export const options = {
  scenarios: {
    hora_pico: {
      executor: 'constant-vus',
      vus: 500,
      duration: '1m',
    },
  },
  thresholds: {
    http_req_failed: ['rate<0.01'],
    http_req_duration: ['p(95)<1000'],
  },
};

export default function () {
  const headers = {
    Accept: 'application/json',
    Authorization: `Bearer ${__ENV.AUTH_TOKEN || ''}`,
  };
  const response = http.get(`${__ENV.BASE_URL || 'http://127.0.0.1:8000'}/pedidos`, { headers });

  check(response, {
    'responde 200': (result) => result.status === 200,
  });
  sleep(1);
}