import axios from "axios";
import React, { useState } from "react";
import ReactDOM from "react-dom/client";
import { crateRoot } from "react-dom/client";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";
import ReactSelect from "react-select";
import BtnLoader from "../Components/BtnLoader";
//blade_movie  blade_movie_category

const category_data = blade_movie_category.map((d) => {
    return { value: d.id, label: d.name };
});
// console.log(category_data);


const selected_category_ids = [];
const selected_category = blade_movie.category.map((c) => {
    selected_category_ids.push(c.id);
    return { value: c.id, label: c.name };
});
// console.log(selected_category);
// console.log(selected_category_ids);



const EditSerie= () => {
    const [loader, setLoader] = useState(false);
    const [directLink, setDirectLink] = useState("");

    const [data, setData] = useState({
        embed_link: blade_movie.embed_link,
        name: blade_movie.name,
        release_date: blade_movie.release_date,
        rating: blade_movie.rating,
        image_url: blade_movie.image,
        description: blade_movie.description,
        category: selected_category_ids,
    });

    const changeTmbId = (v) => {
        const api = `https://api.themoviedb.org/3/tv/${v}?api_key=3bebfc78d15d9cad80823014bb82e16a`;

        // console.log(api);

        axios.get(api).then(({d}) => {
            console.log(d);
            setData({
                ...data,
                name: d.data.original_title,
                release_date: d.data.release_date,
                rating: d.data.vote_average,
                image_url: `https://media.themoviedb.org/t/p/w440_and_h660_face${d.data.poster_path}`,
                description: d.data.overview,
            });
        });

        //         const api = (v) =>
        //   axios.get(`https://api.themoviedb.org/3/movie/${v}`, {
        //     params: {
        //       api_key: import.meta.env.VITE_TMDB_API_KEY, // or hardcode valid key for test
        //       language: "en-US",
        //     },
        //   });
    };

    // const changeData=(type,v)=>{
    //     if(type=='name'){
    //         setData({
    //             ...data,name:v,
    //         });
    //     }
    // }

    const uploadMovie = () => {
        if (directLink == "") {
            return alert("Please enter movie direct source link");
            // return;
        }
        const api = `https://streamhgapi.com/api/upload/url?key=30781d7ii5ivwsmmrxxzq&url=${directLink}`;
        axios.get(api).then((d) => {
            const file_code = d.data.result.filecode;
            setData({
                ...data,
                embed_link: `${file_code}`,

                // embed_link:`https://streamango.com/embed/${file_code}/`,
            });
        });
    };

    // change category
    const changeCategory = (d) => {
        const category_ids = d.map((d) => {
            return d.value;
        });

        setData({
            ...data,
            category: category_ids,
        });
    };

    // store movie
    const storeMovie = () => {
        setLoader(true);
        axios
            .post("/admin/api/update-movie/"+blade_movie.id, data)
            .then((d) => {
                setLoader(false);
                if (d.data == "success") {
                    toast.success("movie update successfully");

                }
                console.log(d);
            })
            .catch((e) => {
                if (e.response.status == 422) {
                    const errData = e.response.data;
                    for (const key in errData) {
                        errData[key].map((singleError) =>
                            toast.error(singleError)
                        );
                    }
                }
            });
        // toast.info("Please wait... Processing");
        // toast("hello world");
    };

    return (
        <>
            <div className="container-fluid mt-5">
                <div className="row">
                    <div className="col-md-8">
                        <div className="form-group">
                            <label htmlFor="title">Enter THDB</label>
                            <input
                                type="text"
                                className="form-control"
                                onChange={(e) => changeTmbId(e.target.value)}
                            />
                        </div>

                        <div className="form-group">
                            <label htmlFor="title">Enter Name</label>
                            <input
                                type="text"
                                className="form-control"
                                id="title"
                                placeholder=""
                                value={data.name}
                                onChange={(e) =>
                                    setData({
                                        ...data,
                                        name: e.target.value,
                                    })
                                }
                            />
                        </div>
                        {/* onChange={e=>changeData('name',e.target.value)} */}



                        <div className="form-group">
                            <label htmlFor="title">Enter Image Url</label>
                            <input
                                type="text"
                                className="form-control"
                                id="title"
                                placeholder="Enter Image Url"
                                value={data.image_url}
                                onChange={(e) =>
                                    setData({
                                        ...data,
                                        image_url: e.target.value,
                                    })
                                }
                            />
                            <img src={data.image_url} style={{ width: 130 }} />
                        </div>
                        {/* https://media.themoviedb.org/t/p/w440_and_h660_face/4CkZl1LK6a5rXBqJB2ZP77h3N5i.jpg */}

                        <div className="form-group">
                            <label htmlFor="">Enter Description</label>
                            <textarea
                                className="form-control"
                                id="description"
                                rows="3"
                                value={data.description}
                                onChange={(e) =>
                                    setData({
                                        ...data,
                                        description: e.target.value,
                                    })
                                }
                            ></textarea>
                        </div>
                    </div>
                    {/* end of col-md-4 first */}

                    {/* Start of col-md-4 sec */}
                    <div className="col-md-4 ">
                        <div className="form-group">
                            <label htmlFor="">Enter movie direct source</label>
                            <input
                                type="text"
                                className="form-control"
                                onChange={(e) => setDirectLink(e.target.value)}
                            />
                            {data.embed_link != "" && (
                                <div>{data.embed_link}</div>
                            )}

                            <button
                                onClick={uploadMovie}
                                className="btn btn-primary mt-2"
                            >
                                Up load
                            </button>
                        </div>


                             <div className="form-group">
                            <label htmlFor="title">Release Date</label>
                            <input
                                type="text"
                                className="form-control"
                                id="title"
                                placeholder=""
                                value={data.release_date}
                                onChange={(e) =>
                                    setData({
                                        ...data,
                                        release_date: e.target.value,
                                    })
                                }
                            />
                        </div>

                        <div className="form-group">
                            <label htmlFor="title">Enter Ratin</label>
                            <input
                                type="number"
                                className="form-control"
                                id="title"
                                placeholder=""
                                value={data.rating}
                                onChange={(e) =>
                                    setData({
                                        ...data,
                                        rating: e.target.value,
                                    })
                                }
                            />
                        </div>

                        <div className="form-group">
                            <label htmlFor="">Choose Category</label>
                            <ReactSelect
                                options={category_data}
                                onChange={(data) => changeCategory(data)}
                                isMulti={true}
                                defaultValue={selected_category}
                                // onChange={data=>console.log(data)}
                            />
                        </div>

                        {/* <select multiple={true}  id="movie_category">
                          {blade_movie_category.map((d)=>(
                            <option key={d.id} value={d.id}>d.name}</op{tion>
                          ))}
                        </select> */}


                    <button disabled={loader} type="submit" className="btn btn-primary mt-3" onClick={storeMovie}>
                       {loader && <BtnLoader /> }
                            Update Movie
                        </button>
                    </div>
                    {/* End of col-md-4 sec */}
                </div>
            </div>
            <ToastContainer />
        </>
    );
};

// const rootElement = document.getElementById("root");
// if (rootElement) {
//     const root = ReactDOM.createRoot(rootElement);
//     root.render(<EditSerie />);
// }


createRoot(document.getElementById("root")).render(<EditSerie/>);
