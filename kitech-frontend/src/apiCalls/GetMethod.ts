import axios from "axios";
import { baseUrl } from "./baseUrl";

interface ApiResponse {
    status: boolean;
    message?: any;
    data: any;
}

const GetMethod =  async (url: string): Promise<ApiResponse>=>{

    const config = {
        url: baseUrl+ url,
        method: "GET",
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

export default GetMethod;