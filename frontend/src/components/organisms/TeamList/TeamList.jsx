import React from "react";
import { List } from "@mui/material";
import TeamListItem from "@/components/molecules/TeamListItem/TeamListItem";

const TeamList = ({ teams, selectedTeams, onSelectTeam }) => (
	<List>
		{teams.map((team) => (
			<TeamListItem
				key={team.id}
				team={team}
				isSelected={selectedTeams.includes(team)}
				onSelect={onSelectTeam}
			/>
		))}
	</List>
);

export default TeamList;


