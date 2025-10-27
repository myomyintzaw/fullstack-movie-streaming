import React, { useEffect,useState } from "react";
import Master from "./Layout/Master";
import axios from "axios";
import LoadingComponent from '../../Components/BtnLoader';

const Sub = () => {
    const [data, setData] = React.useState([]);
    const [expireData,setExpireData]=useState([]);
    const [loader,setLoader]=useState(true);
    React.
    useEffect(() => {
      axios.get("/api/buy-package-list").then((d) => {
        setLoader(false);
        setData(d.data.data);
        setExpireData(d.data.expire_data);
        // console.log(d.data.data);
      });
    }, []);
    return <Master>
    {loader && (<div className="p-5 d-flex align-items-center justify-content-center"><LoadingComponent bgcolor={'bg-green'}  /></div>)}


     {!loader && (
        <>
      <div>
        <span className="btn btn-outline-warning">Expire At:{" "} {expireData !='no_active_plan' ? expireData.expire_date : "No Active Plan"}</span>
      </div>

        <table className="table table-striped mt-3">
        <thead>
            <tr>
                <th>Package Name</th>
                <th>Package Total Day</th>
                <th>Status</th>
                <th>Start Date</th>
            </tr>
            </thead>
            <tbody>
            {data.map((d) => (
                 <tr key={d.id}>
                    <td>{d.package_name}</td>
                    <td>{d.package_total_day}</td>
                    <td>
                    {d.status=='success' && <span className="badge badge-success">Accepted</span>}
                    {d.status=='pending' && <span className="badge badge-warning">Pending</span>}
                    {d.status=='error' && <span className="badge badge-danger">Rejected</span>}
                    </td>
                    <td>{d.created_at}</td>
                </tr>

            ))}

            </tbody>
        </table>
        </>

     )}

    </Master>;
};

export default Sub;
