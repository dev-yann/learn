import axios from 'axios'

export default axios.create({
    baseURL: `http://api.learn.local:10080`
})
