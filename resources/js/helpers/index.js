import { format } from 'date-fns';
import { toZonedTime } from 'date-fns-tz';

export const {
    maskDate,
  } = (() => {
    function maskDate(date) {
      const data = toZonedTime(date, 'UTC')

      return format(data, "dd/MM/yyyy HH:mm:ss")
    }

    return {
      maskDate
    }
})()