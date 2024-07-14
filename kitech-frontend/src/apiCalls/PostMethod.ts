import axios from "axios";
import { baseUrl } from "./baseUrl";

interface ApiResponse {
    status: boolean;
    message?: any;
    data: any;
}

const PostMethod = async (url: string, data: FormData): Promise<ApiResponse>=>{

    const config = {
        url: baseUrl+ url,
        method: "POST",
        data: data, 
        headers: {
            'Content-Type': 'multipart/form-data',
        },
    };

    try{

        const response = await axios.request(config);

        const result = response.data;

        return {status: result.status, message: result.message ,data: result.data};

    }catch(error){

        console.log("Error: " + error);
        return {status: false, message: error, data: []};
    }

}

export default PostMethod;