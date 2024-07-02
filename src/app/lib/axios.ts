import axios from "axios"
import { environment } from "src/environments/environment"

export const axiosInstance = axios.create({
    baseURL: `${environment.baseApiurl}/api`
})