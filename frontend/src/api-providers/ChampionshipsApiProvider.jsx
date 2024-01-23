import axios from "@/utils/axios"

export const postChampionshipsSimulate = async (teams) => {
	const response = await axios.post("championships/simulate", { teams });
	return response.data;
};
