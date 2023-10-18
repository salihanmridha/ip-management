import {useEffect, useState} from "react";
import axiosClient from "../axios-client.js";
import {Link} from "react-router-dom";
import {useStateContext} from "../context/ContextProvider.jsx";

export default function IpAddresses() {
  const [ipAddresses, setipAddresses] = useState([]);
  const [loading, setLoading] = useState(false);
  const {setNotification} = useStateContext()

  useEffect(() => {
    getIps();
  }, [])

  const getIps = () => {
    setLoading(true)
    axiosClient.get('/ip-address')
      .then(({ data }) => {
        setLoading(false)
        setipAddresses(data.data.ip_addresses)
      })
      .catch(() => {
        setLoading(false)
      })
  }

  return (
    <div>
      <div style={{display: 'flex', justifyContent: "space-between", alignItems: "center"}}>
        <h1>IP Address</h1>
        <Link className="btn-add" to="/ip-address/create">Add new</Link>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
          <tr>
            <th>IP Address</th>
            <th>Comment</th>
            <th>IP Address Creator</th>
            <th>Actions</th>
          </tr>
          </thead>
          {loading &&
            <tbody>
            <tr>
              <td colSpan="5" class="text-center">
                Loading...
              </td>
            </tr>
            </tbody>
          }
          {!loading &&
            <tbody>
            {ipAddresses.map(i => (
              <tr key={i.id}>
                <td>{i.ip_address}</td>
                <td>{i.comment}</td>
                <td>{i.user.name}</td>
                <td>
                  <Link className="btn-edit" to={'/ip-address/' + i.id}>Edit</Link>
                </td>
              </tr>
            ))}
            </tbody>
          }
        </table>
      </div>
    </div>
  )
}
