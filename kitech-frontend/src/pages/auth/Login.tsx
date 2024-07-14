import React, { useEffect, useState } from 'react'
import PostMethod from '../../apiCalls/PostMethod';
import { useNavigate } from 'react-router-dom';
import { toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const Login: React.FC = () => {

    const navigate = useNavigate();

    const [redirectUser, setRedirectUser] = useState<boolean>(false);

    useEffect(() => {
        localStorage.getItem("userData") && setRedirectUser(true);
    }, []);

    if (redirectUser === true) { navigate("/"); }

    const [username, setUserName] = useState<string>("");
    const [password, setPassword] = useState<string>("");
    const [buttonText, setButtonText] = useState<string>("Login");
    const [buttonDisabled, setButtonDisabled] = useState<boolean>(false);

    const formHandler = async (e: any) => {
        e.preventDefault();
        setButtonDisabled(true);

        const url = "users/index.php?name=login";

        const formData = new FormData();
        formData.append('username', username);
        formData.append('password', password);

        let response = await PostMethod(url, formData);

        if (response) {
            const { status, message, data } = response;
            if (status === true) {
                let userData = JSON.stringify(data);
                localStorage.setItem("userData", userData);
                toast.success(message);
                navigate("/");
            } else {
                toast.error(message);
                setButtonDisabled(false);
            }
        } else {
            toast.error("Please try again");
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
                                    <input
                                        className="flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                        type="text"
                                        placeholder="Username"
                                        value={username}
                                        onChange={(e) => setUserName(e.target.value)}
                                    ></input>
                                </div>
                            </div>
                            <div>
                                <div className="flex items-center justify-between">
                                    <label htmlFor="" className="text-base font-medium text-gray-900">
                                        Password
                                    </label>
                                </div>
                                <div className="mt-2">
                                    <input
                                        className="flex h-10 w-full rounded-md border border-gray-300 bg-transparent px-3 py-2 text-sm placeholder:text-gray-400 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50"
                                        type="password"
                                        placeholder="Password"
                                        value={password}
                                        onChange={(e) => setPassword(e.target.value)}
                                    ></input>
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