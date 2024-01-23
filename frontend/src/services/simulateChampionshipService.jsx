import { postChampionshipsSimulate } from "@/api-providers/ChampionshipsApiProvider";

const simulate = async (teams, setError, setShowError) => {
	try {
		const response = await postChampionshipsSimulate(teams);
		setShowError(false);
		return response.data;
	} catch (error) {
		setError('Erro ao simular campeonato. Por favor, tente novamente.');
		setShowError(true);
	}
}

export default simulate;
