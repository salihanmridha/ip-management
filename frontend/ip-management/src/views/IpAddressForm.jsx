import { useNavigate, useParams } from "react-router-dom";
import { useEffect, useState } from "react";
import axiosClient from "../axios-client.js";
import { useStateContext } from "../context/ContextProvider.jsx";

export default function IpAddressForm() {
  const navigate = useNavigate();
  let { id } = useParams();
  const [ipAddress, setIpAddress] = useState({
    id: null,
    ip_address: "",
    comment: "",
  });
  const [errors, setErrors] = useState(null);
  const [loading, setLoading] = useState(false);
  const { setNotification } = useStateContext();

  useEffect(() => {
    if (id) {
      setLoading(true);
      axiosClient
          .get(`/ip-address/${id}`)
          .then(({ data }) => {
            setLoading(false);
            setIpAddress(data.data.ip_address);
          })
          .catch(() => {
            setLoading(false);
          });
    }
  }, [id]);

  const onSubmit = (ev) => {
    ev.preventDefault();
    if (ipAddress.id) {
      axiosClient
          .put(`/ip-address/${ipAddress.id}`, ipAddress)
          .then(() => {
            setNotification("Ip address was successfully updated");
            navigate("/ip-address");
          })
          .catch((err) => {
            const response = err.response;
            if (response && response.status === 422) {
              setErrors(response.data.errors);
            }
          });
    } else {
      axiosClient
          .post("/ip-address", ipAddress)
          .then(() => {
            setNotification("Ip address was successfully created");
            navigate("/ip-address");
          })
          .catch((err) => {
            const response = err.response;
            if (response && response.status === 422) {
              setErrors(response.data.errors);
            }
          });
    }
  };

  const isUpdate = () => {
      return ipAddress && ipAddress.ip_address ? true : false;
  }

  return (
      <>
        {ipAddress.id && <h1>Update IP Address: {ipAddress.ip_address}</h1>}
        {!ipAddress.id && <h1>New IP Address</h1>}
        <div className="card animated fadeInDown">
          {loading && (
              <div className="text-center">Loading...</div>
          )}
          {errors && (
              <div className="alert">
                {Object.keys(errors).map((key) => (
                    <p key={key}>{errors[key][0]}</p>
                ))}
              </div>
          )}
          {!loading && (
              <form onSubmit={onSubmit}>
                <input
                    value={ipAddress.ip_address}
                    onChange={(ev) => setIpAddress({ ...ipAddress, ip_address: ev.target.value })}
                    placeholder="IP Address"
                    disabled={isUpdate()}
                />
                <input
                    value={ipAddress.comment}
                    onChange={(ev) => setIpAddress({ ...ipAddress, comment: ev.target.value })}
                    placeholder="Comment"
                />
                <button className="btn">Save</button>
              </form>
          )}
        </div>
      </>
  );
}
