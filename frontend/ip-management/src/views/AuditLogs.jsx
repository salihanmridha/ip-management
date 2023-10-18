import {useEffect, useState} from "react";
import axiosClient from "../axios-client.js";
import {Link} from "react-router-dom";
import {useStateContext} from "../context/ContextProvider.jsx";

export default function AuditLogs() {
  const [auditLogs, setAuditLogs] = useState([]);
  const [loading, setLoading] = useState(false);
  const {setNotification} = useStateContext()

  useEffect(() => {
    getAuditLogs();
  }, [])

  const getAuditLogs = () => {
    setLoading(true)
    axiosClient.get('/audit-log')
      .then(({ data }) => {
        setLoading(false)
        setAuditLogs(data.data.audit_logs)
      })
      .catch(() => {
        setLoading(false)
      })
  }

  return (
    <div>
      <div style={{display: 'flex', justifyContent: "space-between", alignItems: "center"}}>
        <h1>Audit Logs</h1>
      </div>
      <div className="card animated fadeInDown">
        <table>
          <thead>
          <tr>
            <th>Identifier</th>
            <th>Subject</th>
            <th>Event</th>
            <th>Status</th>
            <th>Description</th>
            <th>Creator</th>
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
            {auditLogs.map(a => (
              <tr key={a.id}>
                <td>{a.log_uuid}</td>
                <td>{a.model_name ?? ""}</td>
                <td>{a.event}</td>
                <td>{a.status}</td>
                <td>{a.log_description ?? ""}</td>
                <td>{a.user ? a.user.name : ""}</td>
              </tr>
            ))}
            </tbody>
          }
        </table>
      </div>
    </div>
  )
}
