import { useState } from "react";
import { InputText } from "primereact/inputtext";
import { Button } from "primereact/button";
import { Checkbox } from "primereact/checkbox";
import {Label} from "primereact/label";

export default function Login() {
    const [email, setEmail] = useState("");
    const [password, setPassword] = useState("");
    const [remember, setRemember] = useState(false);

    const handleSubmit = (e) => {
        e.preventDefault();

        console.log({
            email,
            password,
            remember
        });
    };

    return (
        <div
            className="flex justify-content-center align-items-center min-h-screen"
           style={{
    background: "linear-gradient(135deg, #EAF6FF 0%, #F4F0FF 45%, #FFF6F9 100%)"
}}
        >
            <div
                className="surface-card shadow-4 border-round-xl p-5"
                style={{
    width: "430px",
    background: "#FFFFFF",
    borderRadius: "24px",
    border: "1px solid #EEF2FF",
    boxShadow: "0 20px 60px rgba(126, 140, 255, 0.18)",
    padding: "40px"
}}
            >
                <div className="text-center mb-5">

                    <div
                        className="border-circle inline-flex justify-content-center align-items-center mb-3"
                        style={{
    width: "85px",
    height: "85px",
    background: "#EEF4FF",
    borderRadius: "50%"
}}
                    >
                        <i
                            className="pi pi-user"
                            style={{
    color: "#7C83FD",
    fontSize: "2.5rem"
}}
                        />
                    </div>

                    <h2
    style={{
        color: "#344054",
        fontWeight: "700",
        fontSize: "2rem"
    }}
>
    Welcome Back
</h2>
                    <p
    style={{
        color: "#7B8794",
        fontSize: "15px"
    }}
>
    Sign in to continue
</p>

                </div>

                <form onSubmit={handleSubmit}>

                    <div className="mb-4">

                        <label className="block mb-2 font-medium">
                            Email
                        </label>

                        <InputText
                        type="email"
                            value={email}
                            onChange={(e) => setEmail(e.target.value)}
                            placeholder="Enter your email"
    className="w-full"
    style={{
        borderRadius: "14px",
        border: "1px solid #DCE7FF",
        padding: "14px",
    }}
/>

                    </div>

                    <div className="mb-4">

                        <label className="block mb-2 font-medium">
                            Password
                        </label>

                        <InputText
                            type="password"
                            value={password}
                            onChange={(e) => setPassword(e.target.value)}
                            placeholder="Enter your password"
                              className="w-full"
    style={{
        borderRadius: "14px",
        border: "1px solid #DCE7FF",
        padding: "14px",
    }}
                        />

                    </div>

                    <div className="flex justify-content-between align-items-center mb-4">

                        <div className="flex align-items-center gap-2">

                            {/* <Checkbox
                                inputId="remember"
                                checked={remember}
                                onChange={(e) => setRemember(e.checked)}
                            /> */}

                            <label htmlFor="remember">
                                Remember Me
                            </label>

                        </div>

                        <a
                            href="#"
                            className="text-blue-500 no-underline"
                        >
                            Forgot Password?
                        </a>

                    </div>

                    <Button
                        type="submit"
                        icon="pi pi-sign-in"
                        className="w-full"
    style={{
        fontWeight: "600",
        fontSize: "16px",
        borderRadius: "14px",
        border: "1px solid #DCE7FF",
        padding: "14px",
    }}
                    >Login</Button>

                </form>

                <div className="text-center mt-4">

                    <span className="text-600">
                        Don't have an account?
                    </span>

                    <a
                        href="#"
                        className="ml-2 text-blue-500 no-underline font-semibold"
                    >
                        Register
                    </a>

                </div>

            </div>
        </div>
    );
}