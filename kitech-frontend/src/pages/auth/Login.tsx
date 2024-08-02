import React, { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom';
import { toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import { useDispatch, useSelector } from 'react-redux';
import { loginUser } from '../../store/userSlice';
import InputTag from '../components/InputTag';

const Login: React.FC = () => {

    const navigate = useNavigate();
    const dispatch = useDispatch<any>();
    const { user } = useSelector((state: any) => state.user);
    const [username, setUserName] = useState<string>("");
    const [password, setPassword] = useState<string>("");
    const [buttonText] = useState<string>("Login");
    const [buttonDisabled, setButtonDisabled] = useState<boolean>(false);

    const [redirectUser, setRedirectUser] = useState<boolean>(false);

    useEffect(() => {
        if (user && localStorage.getItem("userData")) {
            navigate("/");
        }
        localStorage.getItem("userData") && setRedirectUser(true);
    }, [user, navigate]);

    if (redirectUser === true) { navigate("/"); }


    const formHandler = async (e: any) => {
        e.preventDefault();
        setButtonDisabled(true);

        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);

        let response = await dispatch(loginUser(formData));

        const { status, message } = response.payload;

        if (status === true) {
            toast.success(message);
            navigate("/");
        } else {
            toast.error(message);
            setButtonDisabled(false);
        }
    }

    return (
        <section>
            <div className="flex flex-col items-center justify-center h-dvh">
                <div className="xl:mx-auto xl:w-full xl:max-w-sm 2xl:max-w-md">
                    <h2 className="text-center text-2xl font-bold leading-tight text-black">
                        User Sign In
                    </h2>
                    <form onSubmit={formHandler} method="POST" className="mt-8">
                        <div className="space-y-5">
                            <div>
                                <label htmlFor="" className="text-base font-medium text-gray-900">
                                    Username
                                </label>
                                <div className="mt-2">
                                    <InputTag
                                        inputType={'text'}
                                        inputValue={username}
                                        handleInputChange={(e) => setUserName(e.target.value)}
                                        inputName={'username'}
                                        inputLabel={'Username'} />
                                </div>
                            </div>
                            <div>
                                <div className="flex items-center justify-between">
                                    <label htmlFor="" className="text-base font-medium text-gray-900">
                                        Password
                                    </label>
                                </div>
                                <div className="mt-2">
                                    <InputTag
                                        inputType={'password'}
                                        inputValue={password}
                                        handleInputChange={(e) => setPassword(e.target.value)}
                                        inputName={'password'}
                                        inputLabel={'Password'} />
                                </div>
                            </div>
                            <div>
                                <button type="submit" className="inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-2.5 font-semibold leading-7 text-white hover:bg-black/80" disabled={buttonDisabled} >
                                    {buttonText}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    )
}

export default Login;
