import React, { use } from "react";
import Master from "./Layout/Master";
import axios from "axios";

const Sub = () => {
    const [data, setData] = React.useState([]);
    React.
    useEffect(() => {
      axios.get("/api/buy-package-list").then(d => {
        setData(d.data);
        // console.log(d.data);
      });
    }, []);
    return <Master>
        <table className="table table-striped">
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
    </Master>;
};

export default Sub;
