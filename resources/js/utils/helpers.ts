import moment from "moment";

function padWithZero(number: number) {
  return String(number).padStart(2, '0')
}

function formatDuration(seconds) {

}

export const durationToSeconds = (duration: string): number => {
	const timeParts = duration.split(':')
	const hours = parseInt(timeParts[0], 10)
	const minutes = parseInt(timeParts[1], 10)
	const seconds = parseInt(timeParts[2], 10)

	return hours * 3600 + minutes * 60 + seconds
}

export const secondsToDuration = (seconds: number): string => {
  const hours = Math.floor(seconds / 3600)
  const minutes = Math.floor((seconds % 3600) / 60)
  const remainingSeconds = seconds % 60

  return `${padWithZero(hours)}:${padWithZero(minutes)}:${padWithZero(remainingSeconds)}`
}

export const getPreviousMonth = (subtractMonth: number): moment.Moment => {
	return moment().clone().subtract(subtractMonth, 'month')
}

export const sumDurations = (durations) => {
	return durations
		.map(duration => durationToSeconds(duration))
		.reduce((accumulator, currentValue) => accumulator + currentValue, 0)
}
