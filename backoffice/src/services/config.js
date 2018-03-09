import axios from 'axios'

export default axios.create({
    baseURL: `http://api.learn:10080`
})