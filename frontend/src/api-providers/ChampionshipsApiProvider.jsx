import axios from "@/utils/axios"

export const postChampionshipsSimulate = async (teams) => {
	const response = await axios.post("championships/simulate", { teams });
	return response.data;
};

export const getListChampionships = async (page) => {
	const response = await axios.get(`championships?page=${page}`);
	return response.data;
}
