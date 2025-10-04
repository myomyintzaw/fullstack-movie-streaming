
import React from "react";
import ReactDOM from "react-dom/client";

function Test() {
    return (
        <div>
            <h1>Hello, React!</h1>
            <p>This is a simple React component. Hello</p>
        </div>
    );
}

const rootElement = document.getElementById("root");
if (rootElement) {
    const root = ReactDOM.createRoot(rootElement);
    root.render(<Test />);
}
