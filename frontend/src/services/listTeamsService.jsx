import { listTeams as fetchListTeams } from "@/api-providers/TeamsApiProvider";

const listTeams = async () => {
	try {
		const response = await fetchListTeams();
		return response.data;
	} catch (error) {
		return {};
	}
}

export default listTeams;
