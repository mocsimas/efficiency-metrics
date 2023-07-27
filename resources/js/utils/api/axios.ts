import axios, {CreateAxiosDefaults} from "axios";

const api = axios.create<CreateAxiosDefaults | undefined>({
	baseURL: `${import.meta.env.VITE_APP_DOMAIN}/api/`
})

export default api
