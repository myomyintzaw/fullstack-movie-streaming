import React from "react";
import { useNavigate, useLocation } from "react-router-dom";

const Master = ({ children }) => {
    const go = useNavigate();
    const location = useLocation();
    console.log(location);
    return (
        <>
            <div className="row">
                <div className="col-4 ">
                    <ul className="list-group border border-danger border-3 radius-10">
                        <li
                            className={`list-group-item  border-danger bg-warning text-white ${location.pathname == "/"
                                    ? "bg-primary"
                                    : "bg-transparent"
                                }`}
                            onClick={() => go("/")}
                        >
                            <i
                                className="fa-brands fa-get-pocket mx-2"
                                style={{ color: "#d4e91f" }}
                            ></i>{" "}
                            Your Subscription
                        </li>
                        <li
                            className={`list-group-item  border-danger bg-warning text-white ${location.pathname == "/save-movie"
                                    ? "bg-primary"
                                    : "bg-transparent"
                                }`}
                            onClick={() => go("/save-movie")}
                        >
                            <i
                                className="fa-solid fa-clapperboard mx-2"
                                style={{ color: "#d4e91f" }}
                            ></i>{" "}
                            Save Movie
                        </li>
                        {/* #bed227 */}
                        <li
                            className={`list-group-item  border-danger bg-warning text-white ${location.pathname == "/save-serie"
                                    ? "bg-primary"
                                    : "bg-transparent"
                                }`}
                            onClick={() => go("/save-serie")}
                        >
                            <i
                                className="fa-solid fa-film mx-2"
                                style={{ color: "#d4e91f" }}
                            ></i>{" "}
                            Save Serie
                        </li>
                        <li
                            className={`list-group-item  border-danger bg-warning text-white ${location.pathname == "/setting"
                                    ? "bg-primary"
                                    : "bg-transparent"
                                }`}
                            onClick={() => go("/setting")}
                        >
                            <i
                                className="fa-solid fa-gear mx-2"
                                style={{ color: "#d4e91f" }}
                            ></i>{" "}
                            Change Password
                        </li>
                    </ul>
                </div>
                <div className="col-8">
                    <div className="card p-2 bg-dark">{children}</div>
                </div>
            </div>
        </>
    );
};

export default Master;
