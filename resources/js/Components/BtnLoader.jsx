import React from "react";

const BtnLoader = ({ bgcolor }) => {
    return (
        <div className="d-inline mb-2">
            <span
                class={`spinner-grow  spinner-grow-sm ${bgcolor ? bgcolor : ""}`}
                role="status"
                aria-hidden="true"
            ></span>
            <span class="sr-only">Loading...</span>
        </div>
    );
};

export default BtnLoader;
