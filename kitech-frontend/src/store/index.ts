import { configureStore } from "@reduxjs/toolkit";
import useerReucer from "./userSlice";

const store = configureStore({
    reducer: {
        user: useerReucer,
    },
});

export default store;