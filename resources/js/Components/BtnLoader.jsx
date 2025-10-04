import React from "react";

const BtnLoader = () => {
    return (
        <div className="d-inline mb-2">
            <span
                class="spinner-grow spinner-grow-sm"
                role="status"
                aria-hidden="true"
            ></span>
            <span class="sr-only">Loading...</span>
        </div>
    );
};

export default BtnLoader;
