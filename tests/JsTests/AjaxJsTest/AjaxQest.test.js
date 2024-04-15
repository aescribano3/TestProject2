import { beforeAll, test, describe } from 'vitest';
import axios from 'axios';

const BEFORE_ALL_TIMEOUT = 30000;

describe('fetchJson', () => {
  let response;

  beforeAll(async () => {
    try {
      response = await axios.get(`/cursos/json`);
    } catch (error) {
      console.error(error);
    }
  }, BEFORE_ALL_TIMEOUT);

  test('El ajax develve un json', () => {
    expect(response.status).toBe(200);
    expect(questionExists).toBe(JSON.stringify(response.data));
  });
});
