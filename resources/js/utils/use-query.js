import { useLocation } from "react-router-dom";

export default function useQuery(searching) {
    return new URLSearchParams(useLocation().search).get(searching);
}