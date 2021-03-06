/**
 * -----------------------------------------------------
 * File        calladmin_test.sp
 * Authors     Impact, David <popoklopsi> Ordnung
 * License     GPLv3
 * Web         http://gugyclan.eu, http://popoklopsi.de
 * -----------------------------------------------------
 * 
 * CallAdmin
 * Copyright (C) 2013 Impact, David <popoklopsi> Ordnung
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 */
 
#include <sourcemod>
#include "calladmin"
#pragma semicolon 1



public Plugin:myinfo = 
{
	name = "CallAdmin: Test",
	author = "Impact, Popoklopsi",
	description = "Tests the calladmin plugin",
	version = CALLADMIN_VERSION,
	url = "http://gugyclan.eu"
}




public OnPluginStart()
{
	RegConsoleCmd("calladmin_test", Command_Test);
}




public Action:Command_Test(client, args)
{
	PrintToServer("Current trackercount: %d", CallAdmin_GetTrackersCount());
	
	return Plugin_Continue;
}




public Action:CallAdmin_OnDrawOwnReason(client)
{
	PrintToServer("An own reason menu is drawn to: %N", client);
	
	return Plugin_Continue;
}



public Action:CallAdmin_OnDrawTarget(client, target)
{
	PrintToServer("Client %N is drawn to %N", target, client);
	
	return Plugin_Continue;
}



public CallAdmin_OnTrackerCountChanged(oldVal, newVal)
{
	PrintToServer("Trackercount has changed from %d to %d", oldVal, newVal);
}



public CallAdmin_OnReportPost(client, target, const String:reason[])
{
	PrintToServer("%N was reported by %N for %s", target, client, reason);
}