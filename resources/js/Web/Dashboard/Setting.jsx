
import {useState} from "react";
import Master from "./Layout/Master";
import BtnLoader from "../../Components/BtnLoader";
import axios from "axios";
import { toast,ToastContainer } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const Setting = () => {
    const [current,setCurrent]=useState('');
    const [newPass,setNewPass]=useState('');
    const [loader,setLoader]=useState(false);

const changePass=()=>{
    axios.post("/api/change-password",{current_password:current,new_password:newPass,}).then((d)=>{
        setLoader(false);
        if(d.data=='wrong_current'){
            return toast.error('Current Current Password');
        }
        if(d.data=='success'){
            return toast.success('Password Changed Successfully');
        }

    });
};


    return <Master>
        <div className="form-group">
            <label htmlFor="">Enter Current Password</label>
            <input type="password" className="form-control bg-transparent col-auto" value={current} onChange={(e)=>setCurrent(e.target.value)} />
        </div>
        <div className="form-group">
            <label htmlFor="">Enter New Password</label>
            <input type="password" className="form-control bg-transparent col-auto" value={newPass} onChange={(e)=>setNewPass(e.target.value)} />
        </div>

        <div>
            <button disabled={loader} className="btn btn-primary" onClick={changePass}>
                {loader &&  <BtnLoader/> }
            Change </button>
        </div>
        <ToastContainer/>
    </Master>;
};

export default Setting;
