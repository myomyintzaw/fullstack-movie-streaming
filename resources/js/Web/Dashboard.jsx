import React from "react";
import {createRoot} from "react-dom/client";
import { HashRouter, Route, Routes } from "react-router-dom";
import SaveMovie from "./Dashboard/SaveMovie";
import SaveSerie from "./Dashboard/SaveSerie";
import Setting from "./Dashboard/Setting";
import Sub from "./Dashboard/Sub";


const Dashboard = () => {
    return (
        <HashRouter>
            <Routes>
                <Route path="/" element={<Sub />} />
                <Route path="/save-movie" element={<SaveMovie />} />
                <Route path="/save-serie" element={<SaveSerie />} />
                <Route path="/setting" element={<Setting />} />
            </Routes>
        </HashRouter>
    );
};



createRoot(document.getElementById("dashboard")).render(<Dashboard />);

// const rootElement = document.getElementById("root");
// if (rootElement) {
//     const root = ReactDOM.createRoot(rootElement);
//     root.render(<Dashboard />);
// }
