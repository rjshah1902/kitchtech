import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import PostMethod from "../apiCalls/PostMethod";

const url = "users/index.php?name=login";

export const loginUser = createAsyncThunk(
   "user/loginUser",
   async(formData:any)=>{
        const response = await PostMethod(url, formData);
        
        const { status,  data } = response;

        if (status === true) {
            let userData = JSON.stringify(data);
            localStorage.setItem("userData", userData);
        }
        
        return response;
    },

);

const userSlice = createSlice({
    name: 'user',
    initialState:{
        laoding: false,
        user:null,
        error:null,
    },
    extraReducers(builder) {
        builder.addCase(loginUser.pending,(state)=>{
            state.laoding = true;
            state.user = null;
            state.error = null;
        }).addCase(loginUser.fulfilled,(state, action)=>{
            state.laoding = false;
            state.user = action.payload.data;
            state.error = null;
        }).addCase(loginUser.rejected,(state, action)=>{
            state.laoding = false;
            state.user = null;
            console.log(action.error.message);
            state.error = null;
        });
    },
    reducers: {}
});

export default userSlice.reducer;