import axios from "@/utils/axios";

export const listTeams = async () => {
	const response = await axios.get("teams");
	return response.data;
}

export const getTeam = async (id) => {
	const response = await axios.get(`teams/${id}`);
	return response.data;
}
