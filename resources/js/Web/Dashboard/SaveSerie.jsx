import React, { use, useEffect,useState } from "react";
import Master from "./Layout/Master";
import BtnLoader from "../../Components/BtnLoader";
import axios from "axios";

const SaveSerie = () => {
    const [loader,setLoader]=useState(true);
    const [data,setData]=useState([]);
    useEffect(() => {
        axios.get('/api/get-saved-series').then((d)=>{
            setLoader(false);
            setData(d.data);
        });

    }, []);

    return (
    <Master>
    {loader && (
         <div className="p-5 d-flex align-items-center justify-content-center">
         <BtnLoader bgcolor={'bg-yellow'} />
    </div>
    )}


    {!loader && (
        <div className="container-fluid">
            <div className="row">

      {data.map((d) =>(

        <div key={d.serie.id} className="col-6 col-sm-6 col-md-3 col-lg-3">
        <a href={`/serie/${d.serie.slug}`} >
         <div
            className="movie-card-container position-relative d-flex justify-content-center align-items-center"
            style={{ backgroundImage:`url("${d.serie.image}")`,
            }}>

             {/* rating */}
             <div className="rating position-absolute rounded-circle d-flex justify-content-center align-items-center">
              <span className="text-white">{d.serie.rating_no}</span>
            </div>
             {/* play icon */}
             <div className="play-icon rounded-circle d-flex justify-content-center align-items-center">
             <i className="fa-regular fa-circle-play text-yellow" />
          </div>
         </div>

        </a>

    </div>


    ))}






    </div>
  </div>

        )
    }


    </Master>

  );
};

export default SaveSerie;
