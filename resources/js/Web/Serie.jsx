import axios from "axios";
import React, { useState } from "react";
import { createRoot } from "react-dom/client";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import BtnLoader from "../Components/BtnLoader";
//blade_data
const Serie = () => {
    const [comments, setComments] = useState(blade_data.comment);
    const [comment, setComment] = useState("");
    const [commentLoader, setCommentLoader] = useState(false);
    const [likeCount, setLikeCount] = useState(blade_data.like_count);
    const [saveCount, setSaveCount] = useState(blade_data.serie_save_count);
    const [commentCount, setCommentCount] = useState(blade_data.comment_count);

    const storeComment = () => {
        if (comment == "") {
            return toast.error("enter comment");
        }
        setCommentLoader(true);
        axios
            .post("/api/store-serie-comment", {
                comment,
                movie_id: blade_data.id,
            })
            .then((d) => {
                setCommentLoader(false);
                if (d.data) {
                    setComments([d.data, ...comments]);
                }
                setComment("");
                setCommentCount(commentCount + 1);
                toast.success("comment created success");
            });
    };

    const storeLove = () => {
        axios
            .post("/api/store-serie-like", { movie_id: blade_data.id })
            .then((d) => {
                if (d.data == "already_like") {
                    toast.error("you already like");
                }
                if (d.data == "success") {
                    setLikeCount(likeCount + 1);
                    toast.success("you liked it.");
                }
            });
    };

    const saveMovie = () => {
        axios
            .post("/api/store-serie-save", { movie_id: blade_data.id })
            .then((d) => {
                if (d.data == "already_save") {
                    toast.error("You already save serie");
                }
                if (d.data == "success") {
                    setSaveCount(saveCount + 1);
                    toast.success("You save it.");
                }
            });
    };

    return (
        <div>
            <>
                <div className="row">
                    <div className="col-12">
                        <h2 className="text-white">
                            {blade_data.name} {blade_data.release_year}
                        </h2>
                    </div>
                </div>
                <div className="row">
                    {/* image */}
                    <div className="col-12 col-md-2">
                        {/* https://media.themoviedb.org/t/p/w600_and_h900_bestv2/o8qtMeCskitW5QwSu6O1nP4jN6z.jpg */}
                        <img src={blade_data.image} className="w-100 rounded" />
                        <div className="mt-2 bg-dark p-3 d-flex justify-content-between rounded">
                            <div className="text-center">
                                <i
                                    className="fa-regular fa-heart action-icon text-danger"
                                    onClick={storeLove}
                                />{" "}
                                <br />
                                <small className="text-muted">
                                    {likeCount}
                                </small>
                            </div>
                            <div className="text-center">
                                <i
                                    className="fa-regular fa-comment action-icon text-success"
                                    onClick={storeLove}
                                />{" "}
                                <br />
                                <small className="text-muted">
                                    {commentCount}
                                </small>
                            </div>
                            <div className="text-center">
                                <i
                                    onClick={saveMovie}
                                    className="fa-regular fa-bookmark text-primary action-icon"
                                />{" "}
                                <br />
                                <small className="text-muted">
                                    {saveCount}
                                </small>
                            </div>
                            {/* <i className="fa-regular fa-circle-down text-success action-icon" /> */}
                        </div>
                    </div>
                    {/* desc */}
                    <div className="col-12 col-md-5">
                        <div className="text-muted">
                            Director :{" "}
                            <span className="text-yellow">Amber Sealey</span>
                        </div>
                        <div className="text-muted">
                            Cast :{" "}
                            <span className="text-yellow">
                                Phoebe-Rae Taylor,Jennifer Aniston,Rosemarie
                                DeWitt
                            </span>
                        </div>
                        <div className="text-muted">
                            Genre :{" "}
                            {blade_data.category.map((cd) => (
                                <span key={cd.id} className="text-yellow m-1">
                                    {cd.name}
                                </span>
                            ))}
                        </div>

                        <div className="text-muted">
                            Running Time :{" "}
                            <span className="text-yellow">140 min</span>
                        </div>
                        <div className="text-muted">
                            Country : <span className="text-yellow">USA</span>
                        </div>
                        <div>
                            <h5 className="text-white">Overview</h5>
                            <p>{blade_data.description}</p>
                        </div>
                    </div>
                    {/* video player */}
                    <div className="col-12 col-md-5">
                        {/* <video
                            className="rounded"
                            src="https://www.w3schools.com/html/mov_bbb.mp4"
                            id="moviePlayer"
                            controls=""
                        /> */}

                        {/* <iframe
                            allowFullScreen={true}
                            className="w-100 "
                            src={blade_data.embed_player}
                            frameBorder="0"
                            style={{ height: 315 }}
                        ></iframe> */}

                        <div className="bg-dark p-2 rounded">
                            <span className="btn btn-yellow">1</span>
                            <span className="btn btn-outline-yellow">2</span>
                            <span className="btn btn-outline-yellow">3</span>
                        </div>
                    </div>
                    {/* movie tabs */}
                    <div className="container-fluid">
                        <div className="row mt-5">
                            <div className="col-12 col-md-8">
                                <nav>
                                    <div
                                        className="nav nav-tabs"
                                        id="nav-tab"
                                        role="tablist"
                                    >
                                        <span
                                            className="active"
                                            id="nav-home-tab"
                                            data-toggle="tab"
                                            data-target="#nav-home"
                                            type="button"
                                            role="tab"
                                            aria-controls="nav-home"
                                            aria-selected="true"
                                        >
                                            Comments &amp; Reviews
                                        </span>
                                        <span
                                            className="ml-4"
                                            id="nav-profile-tab"
                                            data-toggle="tab"
                                            data-target="#nav-profile"
                                            type="button"
                                            role="tab"
                                            aria-controls="nav-profile"
                                            aria-selected="false"
                                        >
                                            Photos
                                        </span>
                                    </div>
                                </nav>
                                <div
                                    className="tab-content mt-3"
                                    id="nav-tabContent"
                                >
                                    <div
                                        className="tab-pane fade show active"
                                        id="nav-home"
                                        role="tabpanel"
                                        aria-labelledby="nav-home-tab"
                                    >
                                        {/* comment list */}
                                        <div className="mt-2 bg-dark rounded p-3">
                                            {blade_auth && (
                                                <>
                                                    <textarea
                                                        value={comment}
                                                        onChange={(e) =>
                                                            setComment(
                                                                e.target.value
                                                            )
                                                        }
                                                        className="form-control bg-transparent border border-dark"
                                                        placeholder="enter comment"
                                                    ></textarea>
                                                    <button
                                                        disabled={commentLoader}
                                                        className="btn btn-primary"
                                                        onClick={storeComment}
                                                    >
                                                        {commentLoader && (
                                                            <BtnLoader />
                                                        )}{" "}
                                                        create comment
                                                    </button>
                                                </>
                                            )}
                                            {!blade_auth && (
                                                <div className="alert alert-info">
                                                    Please{" "}
                                                    <a
                                                        href="/login"
                                                        className="btn btn-sm mx-2 btn-dark"
                                                    >
                                                        login
                                                    </a>{" "}
                                                    first
                                                </div>
                                            )}
                                        </div>
                                        {comments.map((d) => (
                                            <div
                                                key={d.id}
                                                className="mt-2 bg-dark rounded p-3"
                                            >
                                                <div className="d-flex comment ">
                                                    <img
                                                        src="https://yt3.ggpht.com/CUOcBRQZX-34V3bj2FLdfSK3G2QU7wwgefuhvIkjUh5aGOYkUFBo7pwPXOoI1fl-1cqGxqig=s68-c-k-c0x00ffffff-no-rj"
                                                        className="rounded-circle"
                                                    />
                                                    <div className="ml-3">
                                                        <b className="d-block text-white">
                                                            {d.user.name}
                                                        </b>
                                                        <small className="text-muted d-block">
                                                            {d.day_ago}
                                                        </small>
                                                    </div>
                                                </div>
                                                <div className="text-muted mt-3">
                                                    {d.comment}
                                                </div>
                                            </div>
                                        ))}
                                    </div>
                                    <div
                                        className="tab-pane fade"
                                        id="nav-profile"
                                        role="tabpanel"
                                        aria-labelledby="nav-profile-tab"
                                    >
                                        <div className="row">
                                            <div className="col-12 col-md-3">
                                                <img
                                                    src="https://media.themoviedb.org/t/p/w500_and_h282_face/t8gYxihohFaDQa6KAL21UkUK4Qt.jpg"
                                                    className="rounded w-100"
                                                />
                                            </div>
                                            <div className="col-12 col-md-3">
                                                <img
                                                    src="https://media.themoviedb.org/t/p/w1000_and_h563_face/thDLoKyWdgK6EWXwGsjYqAFenuN.jpg"
                                                    className="rounded w-100"
                                                />
                                            </div>
                                            <div className="col-12 col-md-3">
                                                <img
                                                    src="https://media.themoviedb.org/t/p/w500_and_h282_face/t8gYxihohFaDQa6KAL21UkUK4Qt.jpg"
                                                    className="rounded w-100"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div className="col-12 col-md-4">
                                <div className="row">
                                    <div className="col-12">
                                        <h3 className="text-white">
                                            Related Movies
                                        </h3>
                                    </div>
                                </div>
                                <div className="row">
                                    {blade_related.map((d) => (
                                        <div
                                            key={d.id}
                                            className="col-6 col-sm-6 col-md-6 col-lg-6 mt-3"
                                        >
                                            <div
                                                className="movie-card-container position-relative d-flex justify-content-center align-items-center"
                                                style={{
                                                    backgroundImage: `url("${d.image}")`,
                                                }}
                                            >
                                                {/* rating */}
                                                <div className="rating position-absolute rounded-circle d-flex justify-content-center align-items-center">
                                                    <span className="text-white">
                                                        {d.rating_no}
                                                    </span>
                                                </div>
                                                {/* play icon */}
                                                <div className="play-icon rounded-circle d-flex justify-content-center align-items-center">
                                                    <i className="fa-regular fa-circle-play text-yellow" />
                                                </div>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </div>
                        {/* end row comment */}
                    </div>
                </div>
                <ToastContainer />
            </>
        </div>
    );
};



createRoot(document.getElementById("serieDetail")).render(<Serie />);
