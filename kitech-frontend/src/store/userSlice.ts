import { createAsyncThunk, createSlice } from "@reduxjs/toolkit";
import PostMethod from "../apiCalls/PostMethod";

const url = "users/index.php?name=login";

export const loginUser = createAsyncThunk(
    "user/loginUser",
    async (formData: any) => {
        const response = await PostMethod(url, formData);

        const { status, data } = response;

        if (status === true) {
            let userData = JSON.stringify({ name: data.name, username: data.username });
            localStorage.setItem("userData", userData);
        }
        return response;
    },

);

const userSlice = createSlice({
    name: 'user',
    initialState: {
        loading: false,
        user: null,
        error: null,
    },
    extraReducers(builder) {
        builder.addCase(loginUser.pending, (state) => {
            state.loading = true;
            state.user = null;
            state.error = null;
        }).addCase(loginUser.fulfilled, (state, action) => {
            state.loading = false;
            state.user = action.payload.data;
            state.error = null;
        }).addCase(loginUser.rejected, (state, action) => {
            state.loading = false;
            state.user = null;
            state.error = null;
        });
    },
    reducers: {
        logout: (state) => {
            state.loading = false;
            state.user = null;
            state.error = null;
        },
    }
});

export const { logout } = userSlice.actions;
export default userSlice.reducer;