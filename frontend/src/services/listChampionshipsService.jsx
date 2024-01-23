import { getListChampionships } from "@/api-providers/ChampionshipsApiProvider";

const listChampionships = async (page, showError, setError) => {
	try {
		const response = await getListChampionships(page);
		return response.data;
	} catch (error) {
		setError(error.message);
		showError(true);
	}
}

export default listChampionships;
